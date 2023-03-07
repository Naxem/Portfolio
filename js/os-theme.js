window.addEventListener("load", function() {
    if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        // Thème sombre activé
        console.log('Thème sombre activé')
    } else {
        // Thème claire activé
        console.log('Thème claire activé')
        let elements = document.getElementsByClassName("dark-os")
        console.log(elements);
        for (let i = 0; i < elements.length; i++) {
            $( ".dark-os" ).removeClass( "dark-os" );
            $( "body" ).addClass( "white-os" );
        }

        elements = document.getElementsByClassName("dark-os-h")
        for (i = 0; i < elements.length; i++) {
            $( ".dark-os-h" ).addClass( "white-os-h");
        }
    }
});