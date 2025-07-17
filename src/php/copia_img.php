<?php
    // para aumentar o tempo no qual o script pode ficar executando.
    ini_set('max_execution_time', 300);
    
    $siteUrl = null;

    if(php_sapi_name() === 'cli') {
        echo "Informe a URL do site do qual você deseja baixar as imagens: ";
        $siteUrl = trim(fgets(STDIN));
    } else {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $siteUrl = $_POST['url'];
        }
    }
    
    $destino = __DIR__ . "../../../imagens";
    if (!is_dir($destino)) {
        mkdir($destino, 0777, true);
    }

    function getAbsoluteUrl($src, $baseUrl) {
        // Se já for uma URL absoluta, retorna como está
        if (filter_var($src, FILTER_VALIDATE_URL)) {
            return $src;
        }

        // Pega apenas a parte base do site (sem o arquivo HTML)
        $parsedUrl = parse_url($baseUrl);
        $base = $parsedUrl['scheme'] . "://" . $parsedUrl['host'];

        // Se houver caminho antes do arquivo HTML, adiciona
        if (isset($parsedUrl['path'])) {
            $path = dirname($parsedUrl['path']);
            if ($path !== "/") {
                $base .= $path;
            }
        }

        // Retorna a URL absoluta
        return rtrim($base, '/') . '/' . ltrim($src, '/');
    }

    function baixarImagem($url, $destino) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64)");
        $imagem = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200 && $imagem) {
            file_put_contents($destino, $imagem);
            return true;
        }
        return false;
    }

    function baixarImagens($url, $destino) {
        // Carregar o HTML do site
        $html = file_get_contents($url);
        $dom = new DOMDocument();
        @$dom->loadHTML($html);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            $imageUrl = getAbsoluteUrl($src, $url);
            $fileName = basename(parse_url($imageUrl, PHP_URL_PATH));
            $filePath = $destino . '/' . $fileName;
           
            if (baixarImagem($imageUrl, $filePath)) {
                echo "Imagem baixada: $fileName\n";
            } else {
                echo "Falha ao baixar: $imageUrl\n";
            }
           
        }
    }

    baixarImagens($siteUrl, $destino);
    if(php_sapi_name() === 'cli') {
        echo "Processo concluído.";
    } else {
        $_SESSION['flash'] = 'Finalizado com sucesso!';
        header('Location: index.php');
        exit;
    }
    
?>
