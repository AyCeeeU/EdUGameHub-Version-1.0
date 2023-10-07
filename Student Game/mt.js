// JavaScript (mt.js)

var linkList = [];
var linkCorrection = [
  { dragId: "1-draggable", dropId: "7-dropzone", color: "#33991a" },
  { dragId: "2-draggable", dropId: "5-dropzone", color: "#4c061d" },
  { dragId: "3-draggable", dropId: "11-dropzone", color: "#d17a22" },
  { dragId: "4-draggable", dropId: "4-dropzone", color: "#3b3923" },
  { dragId: "5-draggable", dropId: "2-dropzone", color: "#3b5249" }
];

function getRandomColor(id) {
  var colorArray = ["#264653", "#2a9d8f", "#e9c46a", "#f4a261", "#e76f51"];
  return colorArray[id - 1];
}

function Correction() {
  linkList.forEach(userR => {
    var test = linkCorrection.find(cor => {
      return cor.dragId == userR.dragId && cor.dropId == userR.dropId;
    });
    if (test) {
      userR.color = "green";
    } else {
      userR.color = "red";
    }
  });
  drawLinks();
}

/****Add event****/
function addEventsDragAndDrop(el) {
  el.addEventListener('dragstart', onDragStart, false);
  el.addEventListener('dragend', onDragEnd, false);
}

function addTargetEvents(target) {
  target.addEventListener('dragover', onDragOver, false); 
  target.addEventListener('drop', onDrop, false);
}

/****DRAG AND DROP****/
function onDragStart(event) {
  event
    .dataTransfer
    .setData('text/plain', event.target.id);
}

function onDragOver(event) { 
  event.preventDefault();
}

function onDragEnd(event) { 
  event.preventDefault();
}

function onDrop(event) {
  const dragId = event
    .dataTransfer
    .getData('text');

  const dropId = event.target.id;
  Drop(dragId, dropId);
}

function Drop(dragId, dropId) {
  var deselected = linkList.filter(obj => {
    return obj.dragId == dragId || obj.dropId == dropId;
  });
  if (deselected.length) {
    deselected.forEach(x => {
      $("#" + x.dropId).find("i").css("font-weight", "400");
      $("#" + x.dropId).find("i").css("color", "black");
      $("#" + x.dropId).find("i").removeClass('linked');
      $("#" + x.dragId).find("i").css("font-weight", "400");
      $("#" + x.dragId).find("i").css("color", "black");
    });
  }

  linkList = linkList.filter(obj => {
    return obj.dragId != dragId;
  });
  linkList = linkList.filter(obj => {
    return obj.dropId != dropId;
  });

  linkList.push({ dragId, dropId });
  drawLinks();
}

/****Draw final line****/
function drawLinks() {
  var canvas = $('#canvas').get(0);
  var ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  linkList.forEach(link => drawLink(link.dragId, link.dropId, link.color));
}

function drawLink(obj1, obj2, pColor) {
  var canvas = $('#canvas').get(0);
  var ctx = canvas.getContext('2d');

  var $obj1 = $("#" + obj1);
  var $obj2 = $("#" + obj2);
  var parent = $('#dragQuestion').offset();
  var p1 = $obj1.offset();
  var w1 = $obj1.width();
  var h1 = $obj1.height();
  var p2 = $obj2.offset();
  var w2 = $obj2.width();
  var h2 = $obj2.height();
  var wc = $('#canvas').width();
  ctx.beginPath();
  ctx.strokeStyle = pColor ? pColor : color;
  ctx.lineWidth = 3;
  ctx.moveTo(0, p1.top - parent.top + (h1 / 2) - 20 - 2);
  ctx.bezierCurveTo(wc / 2, p1.top - parent.top + (h1 / 2) - 20 - 2,
    wc / 2, p2.top - parent.top + (h2 / 2) - 20 - 2,
    wc - 4, p2.top - parent.top + (h2 / 2) - 20 - 2);
  ctx.stroke();

  $obj1.children().css("color", pColor ? pColor : color);
  $obj1.children().css("font-weight", "900");
  $obj2.children().css("color", pColor ? pColor : color);
  $obj2.children().css("font-weight", "900");
  $obj2.children().addClass('linked');
}

function clearPath(event) {
  var ident = event.currentTarget.id;
  linkList = linkList.filter(obj => {
    return obj.dropId != ident
  });
  $("#dragQuestion").find("i").removeClass('linked');
  $("#dragQuestion").find("i").css("font-weight", "400");
  $("#dragQuestion").find("i").css("color", "black");
  drawLinks();
}

/****Draw path mouse line****/
function drawLinkTemp(obj1, coordPt) {
  var canvas = $('#canvasTemp').get(0);
  var ctx = canvas.getContext('2d');

  var $obj1 = $("#" + obj1);
  var parent = $('#dragQuestion').offset();
  var p1 = $obj1.offset();
  var w1 = $obj1.width();
  var h1 = $obj1.height();
  var p2 = coordPt;
  var c = $('#canvasTemp').offset();

  ctx.beginPath();
  ctx.strokeStyle = color;
  ctx.lineWidth = 3;
  ctx.moveTo(0, p1.top - parent.top + (h1 / 2) - 20 - 2);

  ctx.bezierCurveTo((p2.left - c.left) / 2, p1.top - parent.top - 19 - 2,
    (p2.left - c.left) / 2, p2.top - parent.top - 19 - 2,
    p2.left - c.left, p2.top - parent.top - 19 - 2);
  clearPathTemp();
  ctx.stroke();
}

function clearPathTemp() {
  var canvas = $('#canvasTemp').get(0);
  var ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}

/****Init & Misc****/
$(document).ready(function () {
  var height = $('#dragUL').height();
  $('#canvas').attr("height", height);
  $('#canvas').attr("width", $('#canvas').width());

  $('#canvasTemp').attr("width", $('#canvasTemp').width());
  $('#canvasTemp').attr("height", height);

  $('#dragQuestion').bind('dragover', function () {
    var top = window.event.pageY,
      left = window.event.pageX;
    drawLinkTemp(startPoint, { top, left });
  });

  $("#dragUL").find("div").toArray().forEach(dragEl => addEventsDragAndDrop(dragEl));
  $("#dropUL").find("div").toArray().forEach(dropEl => addTargetEvents(dropEl));

  drawLinks();
});
