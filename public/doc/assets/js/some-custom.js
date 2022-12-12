// Background Image Js
const bgSelector = $("[data-bg-img]");
bgSelector.each(function (index, elem) {
  let element = $(elem),
    bgSource = element.data('bg-img');
  element.css('background-image', 'url(' + bgSource + ')');
});

// Margin Top Js
const marginTopcl = $("[data-margin-top]");
marginTopcl.each(function (index, elem) {
  let element = $(elem),
    marginTop = element.data('margin-top');
  element.css('margin-top', marginTop);
});
