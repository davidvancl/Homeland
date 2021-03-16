function changeDefaultVolume(){
    let audioElements = document.getElementsByClassName("audio");

    Array.prototype.forEach.call(audioElements, function(element) {
        element.volume = 0.2;
    });
}