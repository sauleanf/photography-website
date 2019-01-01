//get array of all modal images (redirects when image is clicked)
const images = document.getElementsByClassName("image-box-modal");

for (let i = 0; i < images.length; i++) {
  const element = images[i]
  //redirects the user
  element.addEventListener('click', () => {
    const id = element.getAttribute('id');
    window.location.href = 'image_view?id=' + id;
  }, false);
}

//elements of the document (btns)
const noTags = document.getElementById('all-id');
const photography = document.getElementById('photography-id');
const parkour = document.getElementById('parkour-id');

//an array of those btns
const elementArray = [photography, parkour, noTags];

//changes the css off the all tags button immediately to indicate its active state
elementArray[2].classList.add("tag-pressed");

//gets an array of the card images elements
const cardImages = document.getElementsByClassName('card-image');

/*iterates over the element array and attaches an event listener that manipulates
the dom so that the posts (card images) without the tag are removed and the ones with the tags aren't
*/
for(let i = 0; i < elementArray.length; i++) {
  elementArray[i].addEventListener('click', () => {
    const index = i;
    //change the background color of the buttons to show that it is active
    for(let j = 0; j < elementArray.length; j++) {
      const loopIndex = j;
      //tag-pressed is the css class with the changed background
      if(loopIndex === index) {
        elementArray[loopIndex].classList.add('tag-pressed');
      }
      else {
        elementArray[loopIndex].classList.remove('tag-pressed');
      }
    }
    //fades in all of the photography card images and fade out all of the rest
    for(let j = 0; j < cardImages.length; j++) {
      const parsedString = cardImages[j].children[1].getAttribute('value');
      const tag = parsedString[i];
      if(tag === "1") {
        $(cardImages[j]).fadeOut(200);
      }
      else {
        $(cardImages[j]).fadeIn(200);
      }
    }
  });
}
