<!doctype html>

<html>

<head>
    <title>Convertisseur</title>
    <link rel="stylesheet" href="./style/mainTemplate.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
</head>

<body>
    <h1>CSV to JSON converter</h1>
    <div id="file-boxes">
        <div id="file-box">
            <p id="title">JSON du fichier in.csv</p>
            <textarea id="in" type="text" name="in" rows="15" cols="80" readonly> <?php echo $prettyIn ?></textarea>
            <a id="download-button" href="fichierJson/in.json" download="in.json">Download in.json</a>
        </div>

        <div id="file-box">
            <p id="title">JSON du fichier extra.csv</p>
            <textarea id="extra" type="text" name="extra" rows="15" cols="80" readonly> <?php echo $prettyExtra ?></textarea>
            <a id="download-button" href="fichierJson/extra.json" download="extra.json">Download extra.json</a>
        </div>

        <div id="file-box">
            <p id="title">JSON des fichiers extra.csv et in.csv mergé</p>
            <textarea id="merged" type="text" name="merged" rows="15" cols="80" readonly> <?php echo $prettyMerge ?></textarea>
            <a id="download-button" href="fichierJson/merged-files.json" download="merged-files.json">Download json merged files</a>
        </div>
    </div>
</body>

</html>