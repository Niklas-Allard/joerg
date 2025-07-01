let url = "Bullerbü 1 - Wir Kinder aus Bullerbü .wav";

url = url.replace(/ö/g, "oe");
url = url.replace(/ä/g, "ae");
url = url.replace(/ü/g, "ue");
url = url.replace(/Ö/g, "Oe");
url = url.replace(/Ä/g, "Ae");
url = url.replace(/Ü/g, "Ue");
url = url.replace(/ß/g, "ss");

console.log(url); // Output: Bullerbue 1 - Wir Kinder aus Bullerbue.wav