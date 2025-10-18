const canvas = document.getElementById("signaturePad");
const ctx = canvas.getContext("2d");
const clearBtn = document.getElementById("clearSignature");
const signatureData = document.getElementById("signatureData");

let drawing = false;

function startDrawing(e) {
  drawing = true;
  ctx.beginPath();
  ctx.moveTo(getX(e), getY(e));
  e.preventDefault();
}

function draw(e) {
  if (!drawing) return;
  ctx.lineTo(getX(e), getY(e));
  ctx.strokeStyle = "#000"; // warna hitam
  ctx.lineWidth = 2;
  ctx.stroke();
  e.preventDefault();
}

function stopDrawing(e) {
  if (!drawing) return;
  drawing = false;
  ctx.closePath();
  // simpan data canvas ke hidden input
  signatureData.value = canvas.toDataURL();
  e.preventDefault();
}

function getX(e) {
  return e.clientX - canvas.getBoundingClientRect().left;
}

function getY(e) {
  return e.clientY - canvas.getBoundingClientRect().top;
}

// Event mouse
canvas.addEventListener("mousedown", startDrawing);
canvas.addEventListener("mousemove", draw);
canvas.addEventListener("mouseup", stopDrawing);
canvas.addEventListener("mouseout", stopDrawing);

// Event touch (mobile)
canvas.addEventListener("touchstart", (e) => startDrawing(e.touches[0]));
canvas.addEventListener("touchmove", (e) => draw(e.touches[0]));
canvas.addEventListener("touchend", (e) => stopDrawing(e.changedTouches[0]));

// Clear canvas
clearBtn.addEventListener("click", () => {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  signatureData.value = "";
});
