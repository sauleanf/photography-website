const images = document.getElementsByClassName('img-dashboard');

for(let i = 0; i < images.length; i++) {
  console.log('-----------------');
  images[i].style.width = "" + images[i].children[0].clientWidth + "px";
  console.log(images[i].children[0].clientWidth);
  console.log(images[i].clientWidth);
}
