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

//gets an array of the card images elements
const cardImages = document.getElementsByClassName('card-image');

//event listener for the photography tag button
photography.addEventListener('click', () => {
  //changes the css of the tags buttons
  photography.classList.add('tag-pressed');
  parkour.classList.remove("tag-pressed");
  noTags.classList.remove("tag-pressed");
  //fades in all of the photography card images and fade out all of the rest
  for(let i = 0; i < cardImages.length; i++) {
    const parsedString = cardImages[i].children[1].getAttribute('value');
    const parkour = parsedString[0];
    const photography = parsedString[1];
    if(photography === "1") {
      $(cardImages[i]).fadeOut(200);
    }
    else {
      $(cardImages[i]).fadeIn(200);
    }
  }
});

//event listener for the parkour tag button
parkour.addEventListener('click', () => {
  //changes the css of the tags buttons
  photography.classList.remove('tag-pressed');
  parkour.classList.add("tag-pressed");
  noTags.classList.remove("tag-pressed");
  //fades in all of the parkour card images and fade out all of the rest
  for(let i = 0; i < cardImages.length; i++) {
    const parsedString = cardImages[i].children[1].getAttribute('value');
    const parkour = parsedString[0];
    const photography = parsedString[1];
    if(parkour === "1") {
      $(cardImages[i]).fadeOut(200);
    }
    else {
      $(cardImages[i]).fadeIn(200);
    }
  }
});

//event listener for the no tags button
noTags.addEventListener('click', ()=> {
  //changes the css of the tags buttons
  photography.classList.remove('tag-pressed');
  parkour.classList.remove("tag-pressed");
  noTags.classList.add("tag-pressed");
  //fades in all of the card images regardless of tags
  for(let i = 0; i < cardImages.length; i++) {
    $(cardImages[i]).fadeIn(200);
  }
})
