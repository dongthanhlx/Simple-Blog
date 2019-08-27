tinymce.init({
    selector:'textarea'
});

var count = 1;
function joinComment() {
    count++;
    if (count%2 == 0) {
        document.getElementById("comment-form").style.display = 'block';
    } else {
        document.getElementById("comment-form").style.display = 'none';
    }
}


function isDelete() {
    document.getElementById("delete").style.display = 'block';
}

function displayAddTopic() {
    count++;
    if (count%2 == 0) {
        document.getElementById("add-topic").style.display = 'block';
    } else {
        document.getElementById("add-topic").style.display = 'none';
    }
}