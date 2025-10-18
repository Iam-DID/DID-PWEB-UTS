const API_BASE = "https://www.emsifa.com/api-wilayah-indonesia/api";

const provinsiEl = document.getElementById("provinsi");
const kabupatenEl = document.getElementById("kabupaten");
const kecamatanEl = document.getElementById("kecamatan");
const kelurahanEl = document.getElementById("kelurahan");

function populateSelect(selectEl, items, placeholder) {
  selectEl.innerHTML = "";
  const opt0 = document.createElement("option");
  opt0.value = "";
  opt0.textContent = placeholder || "-- Pilih --";
  opt0.disabled = true;
  opt0.selected = true;
  selectEl.appendChild(opt0);

  items.forEach(it => {
    const o = document.createElement("option");
    o.value = it.name;
    o.textContent = it.name;
    o.dataset.id = it.id;
    selectEl.appendChild(o);
  });

  selectEl.disabled = false;
}

function setDefault(selectEl, text) {
  selectEl.innerHTML = `<option value="">${text}</option>`;
  selectEl.disabled = true;
}

function setLoading(selectEl, text = "Memuat...") {
  selectEl.innerHTML = `<option value="">${text}</option>`;
  selectEl.disabled = true;
}

async function fetchJson(url) {
  try {
    const res = await fetch(url);
    if (!res.ok) throw new Error("HTTP " + res.status);
    return await res.json();
  } catch (err) {
    console.error("Fetch error:", err, url);
    return null;
  }
}

async function loadProvinces() {
  setLoading(provinsiEl, "Memuat provinsi...");
  const data = await fetchJson(`${API_BASE}/provinces.json`);
  if (data) {
    populateSelect(provinsiEl, data, "-- Pilih provinsi --");
  } else {
    provinsiEl.innerHTML = `<option value="">Gagal memuat provinsi</option>`;
    provinsiEl.disabled = true;
  }

  setDefault(kabupatenEl, "Pilih provinsi terlebih dahulu");
  setDefault(kecamatanEl, "Pilih kabupaten/kota terlebih dahulu");
  setDefault(kelurahanEl, "Pilih kecamatan terlebih dahulu");
}

provinsiEl.addEventListener("change", async function () {
  const idProv = this.options[this.selectedIndex].dataset.id; // ambil id dari dataset
  if (!idProv) return;

  setLoading(kabupatenEl, "Memuat kabupaten/kota...");
  setDefault(kecamatanEl, "Pilih kabupaten/kota terlebih dahulu");
  setDefault(kelurahanEl, "Pilih kecamatan terlebih dahulu");

  const data = await fetchJson(`${API_BASE}/regencies/${idProv}.json`);
  if (data) {
    populateSelect(kabupatenEl, data, "-- Pilih kabupaten/kota --");
  } else {
    setDefault(kabupatenEl, "Gagal memuat kabupaten/kota");
  }
});

kabupatenEl.addEventListener("change", async function () {
  const idKab = this.options[this.selectedIndex].dataset.id;
  if (!idKab) return;

  setLoading(kecamatanEl, "Memuat kecamatan...");
  setDefault(kelurahanEl, "Pilih kecamatan terlebih dahulu");

  const data = await fetchJson(`${API_BASE}/districts/${idKab}.json`);
  if (data) {
    populateSelect(kecamatanEl, data, "-- Pilih kecamatan --");
  } else {
    setDefault(kecamatanEl, "Gagal memuat kecamatan");
  }
});

kecamatanEl.addEventListener("change", async function () {
  const idKec = this.options[this.selectedIndex].dataset.id;
  if (!idKec) return;

  setLoading(kelurahanEl, "Memuat kelurahan/desa...");
  const data = await fetchJson(`${API_BASE}/villages/${idKec}.json`);
  if (data) {
    populateSelect(kelurahanEl, data, "-- Pilih kelurahan/desa --");
  } else {
    setDefault(kelurahanEl, "Gagal memuat kelurahan/desa");
  }
});

document.addEventListener("DOMContentLoaded", loadProvinces);
