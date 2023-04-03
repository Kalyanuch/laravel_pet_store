document.getElementById('remove_image').addEventListener('click', function(e) {
    // console.log('###HELLO');
    e.preventDefault();
    const is_removed = document.getElementById('is_remove_image');
    const img_tag = document.getElementById('image');

    console.log('###is_removed', is_removed);

    if (is_removed) is_removed.value = 1;
    if (img_tag) img_tag.classList.remove('d-none');

    // document.getElementById('image').removeClass('d-none');
    this.parentElement.querySelector('img').remove();
    this.remove();
});
