var x = document.getElementsByClassName("image-box-modal");
var i;
for (i = 0; i < x.length; i++) {
  const element = x[i]
  element.addEventListener('click', () => {
    const id = element.getAttribute('id');
    window.location.href = 'image_view?id=' + id;
  }, false);
}
