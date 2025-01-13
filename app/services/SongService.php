<?php

namespace App\Services;

use App\Repositories\Song\SongRepositoryInterface;

class SongService
{
    private $songRepository;

    public function __construct(SongRepositoryInterface $songRepository)
    {
        $this->songRepository = $songRepository;
    }

    public function createSong(array $data)
    {
        try {
            $videoId = $this->extractVideoId($data['url']);
            $videoInfo = $this->getVideoInfo($videoId);

            $existingSong = $this->songRepository->findById([
                'youtube_id' => $videoInfo['youtube_id']
            ]);

            if ($existingSong) {
                return ['status' => false, 'message' => 'Esta música já está cadastrada.'];
            }

            $this->songRepository->create([
                'title' => $videoInfo['title'],
                'views' => $videoInfo['views'],
                'youtube_id' => $videoInfo['youtube_id'],
                'thumbnail' => $videoInfo['thumb'],
                'link' => $videoInfo['link'],
                'status' => 'pending',
            ]);

            return ['status' => true, 'message' => 'Música adicionada com status "pending".'];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function getPerStatus(string $status, int $page, int $limit)
    {
        $response = $this->songRepository->getPerStatus($status, $page, $limit);

        if (!empty($response)) {
            return [
                'status' => true,
                'message' => 'Músicas encontradas com sucesso.',
                'total' => $response['total'],
                'songs' => $response['data'],
                'page' => $response['page'],
                'limit' => $response['limit'],
            ];
        }
        return ['status' => false, 'message' => "Nenhuma música encontrada."];
    }

    public function findAll(string $status)
    {
        $response = $this->songRepository->findAll($status);

        if ($response) {
            return [
                'status' => true,
                'message' => 'Músicas encontradas com sucesso.',
                'songs' => $response,
            ];
        }
        return ['status' => false, 'message' => "Nenhuma música encontrada."];
    }

    public function approveSong($id)
    {
        return $this->songRepository->update($id, 'approved');
    }

    public function rejectSong($id)
    {
        return $this->songRepository->update($id, 'rejected');
    }

    public function deleteSong($id)
    {
        $deleted = $this->songRepository->delete($id);

        if ($deleted) {
            return [
                'status' => true,
                'message' => 'Música deletada com sucesso.',
            ];
        }

        return [
            'status' => false,
            'message' => 'Música não encontrada ou não pôde ser deletada.',
        ];
    }

    private function extractVideoId(string $url): string
    {
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        throw new \InvalidArgumentException('URL inválida. Não foi possível extrair o ID do vídeo.');
    }


    private function getVideoInfo(string $videoId): array
    {
        $url = "https://www.youtube.com/watch?v=" . $videoId;

        $client = new \GuzzleHttp\Client();

        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ]
        ]);


        try {
            $response = $client->get($url);

            // Obtém o conteúdo da resposta
            $body = $response->getBody()->getContents();

            // extrai o título do vídeo
            if (preg_match('/<title>(.*?) - YouTube<\/title>/', $body, $matches)) {
                $title = html_entity_decode($matches[1], ENT_QUOTES);
            } else {
                throw new \RuntimeException('Título do vídeo não encontrado.');
            }

            // extrai as visualizações do vídeo
            if (preg_match('/"viewCount":\s*"(\d+)"/', $body, $matches)) {
                $views = (int)$matches[1];
            } else {
                $views = 0;
            }

            return [
                'title' => $title,
                'views' => $views,
                'youtube_id' => $videoId,
                'thumb' => 'https://img.youtube.com/vi/'.$videoId.'/hqdefault.jpg',
                'link' => "https://www.youtube.com/watch?v=" . $videoId,
            ];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw new \RuntimeException('Erro na requisição à página do YouTube: ' . $e->getMessage());
        }
    }
}
