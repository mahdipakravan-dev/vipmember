function setStorate(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

function getStorage(key) {
    return JSON.parse(localStorage.getItem(key));
}

function delStorage(key) {
    localStorage.removeItem(key);
}

function delAllStorage() {
    localStorage.clear();
}
