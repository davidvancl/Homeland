function preloadTable(){
    let hideElements = document.getElementsByClassName("hidden");
    Array.prototype.forEach.call(hideElements, function(element) {
        element.setAttribute("hidden","true");
    });

    let removeElements = document.getElementsByClassName("rowspan");
    Array.prototype.forEach.call(removeElements, function(element) {
        element.rowSpan = element.getAttribute('data-count');
    });
}