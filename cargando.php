<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deitoon</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
 
 
<style>
    .loading {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #381b1ba6;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: 1s all;
        opacity: 0;
    }
    .loading.show {
        opacity: 1;
    }
    .loading .spin {

        border: 12px solid white;
        border-top-color: #381b1ba6;
        border-radius: 50%;
        width: 4em;
        height: 4em;
        animation: spin 1s linear infinite;

    }
    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }  
</style>

</head>
<body>

<div class="loading show">
   	<div class="spin"></div>
</div>

</body>
</html>