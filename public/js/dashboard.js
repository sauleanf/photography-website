//gets the images in the dashboard container
const images = document.getElementsByClassName('img-dashboard');

//sets the width of the main image container to the width of the child image
for(let i = 0; i < images.length; i++) {
  images[i].style.width = "" + images[i].children[0].clientWidth + "px";
}
