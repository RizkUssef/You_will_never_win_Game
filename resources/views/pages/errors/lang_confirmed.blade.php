<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang("public.title")</title>
    <link rel = "icon" href ="{{asset('img/FTRU.svg')}}"  type = "image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@1&family=Nunito:wght@300&family=Square+Peg&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('sass/main.css')}}">
</head>
<body>
        <section id="section" class="error_container">
            <div class="all">
                <div class="error_image">
                    <img src="{{asset("img/forget.gif")}}">
                </div>
                <div class="error_head">
                    <h1>@lang("public.msg") </h1>
                    <a href="{{route("lang",["lang"=>"en"])}}">@lang("public.en")</a>
                    <a href="{{route("lang",["lang"=>"ar"])}}">@lang("public.ar")</a>
                    <a href="{{route("lang",["lang"=>"gk"])}}">@lang("public.gk")</a>
                </div>
            </div>
        </section>
        <script>
            var section = document.getElementById("section");
            function removeSection() {
                section.parentNode.removeChild(section);
            }
            setTimeout(removeSection, 5000);
        </script>
</body>
</html>