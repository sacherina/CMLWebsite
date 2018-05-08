function pageX(elem) {
  return elem.offsetParent ?
    elem.offsetLeft + pageX(elem.offsetParent) :
    elem.offsetLeft;
}

function pageY(elem) {
  return elem.offsetParent ?
    elem.offsetTop + pageY(elem.offsetParent) :
    elem.offsetTop;
}

function scrollX() {
  var de = document.documentElement;
  return self.pageXOffset || (de && de.scrollLeft) || document.body.scrollLeft;
}

function scrollY() {
  var de = document.documentElement;
  return self.pageYOffset || (de && de.scrollTop) || document.body.scrollTop;
}

function viewportWidth() {
  return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
}

function viewportHeight() {
  return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
}

function floatNavbar() {
  var nav = document.getElementById('floatingNavbar');
  var stationaryNav = document.getElementById('navbar');
  var yScroll = scrollY();
  var elemY = pageY(stationaryNav);
  var rect = stationaryNav.getBoundingClientRect();
  var isVisible = yScroll + rect.bottom > yScroll;
  var w = viewportWidth();
  if(w > 700){
    if(isVisible){
      if(nav.style.display !== "none"){
        nav.style.display = "none";
      }
    }
    if(!isVisible){
      if(nav.style.display !== ""){
        nav.style.display = "";
      }
    }
  }
  else{ //width < 700
    if(nav.style.display !== "none"){
        nav.style.display = "none";
      }
  }
}

//addEvent and removeEvent helper function copied from Pro Javascript Techniques
function addEvent(element, type, handler) {
  // assign each event handler a unique ID
  if (!handler.$$guid) handler.$$guid = addEvent.guid++;
  // create a hash table of event types for the element
  if (!element.events) element.events = {};
  // create a hash table of event handlers for each element/event pair
  var handlers = element.events[type];
  if (!handlers) {
    handlers = element.events[type] = {};
    // store the existing event handler (if there is one)
    if (element["on" + type]) {
      handlers[0] = element["on" + type];
    }
  }
  // store the event handler in the hash table
  handlers[handler.$$guid] = handler;
  // assign a global event handler to do all the work
  element["on" + type] = handleEvent;
};
// a counter used to create unique IDs
addEvent.guid = 1;

function removeEvent(element, type, handler) {
  // delete the event handler from the hash table
  if (element.events && element.events[type]) {
    delete element.events[type][handler.$$guid];
  }
};

function handleEvent(event) {
  // grab the event object (IE uses a global event object)
  event = event || window.event;
  // get a reference to the hash table of event handlers
  var handlers = this.events[event.type];
  // execute each event handler
  for (var i in handlers) {
    this.$$handleEvent = handlers[i];
    this.$$handleEvent(event);
  }
};

addEvent(document, "scroll", floatNavbar);

window.onunload = function() {
  removeEvent(document, "scroll", floatNavbar);
  var nav = document.getElementById('floatingNavbar');
  nav.style.display = "none";
}
