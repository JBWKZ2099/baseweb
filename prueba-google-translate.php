<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>
        How To Add Google Translate
        Button On Your Webpage ?
    </title>
</head>

<body>
    <p>Hello everyone!</p>
    <p>Welcome to GeeksforGeeks</p>

    <p>
        Translate this page in
        your preferred language:
    </p>

    <p>
        You can translate the content of this
        page by selecting a language in the
        select box.
    </p>

    <div id="translate-select"></div>


    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'translate-select'
            );
        }
    </script>
</body>

</html>