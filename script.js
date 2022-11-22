import languages from "./languages.js";

const selectFirst = document.querySelector(".first")
const selectSecond = document.querySelector(".second")
const translate = document.querySelector(".translate")

const language1 = "en-GB"
const language2 = "es-ES"

for(const i in languages){
    const key = Object.keys(languages[i]).toString()
    const value = Object.values(languages[i]).toString()
    selectFirst.innerHTML += `<option value =${key}>${value}</option>`
    selectSecond.innerHTML += `<option value =${key}>${value}</option>`
}

selectFirst.value = language1
selectSecond.value = language2

translate.addEventListener("click",async _=>{
    const res = await fetch(`https://api.mymemory.translated.net/get?q=text&langpair=${language1}|${language2}`)
    const data = await res.json()
    console.log(data.responseData.translatedText)
})