
const DEST_KEY = 'lugarlang-destination';

export function setDestination(id) {
    localStorage.setItem(DEST_KEY, id);
}

export function getDestination() {
    return localStorage.getItem(DEST_KEY);
    
}

export function getDestination() {
    return JSON.parse(localStorage.getItem("chosenDestination"));
}

