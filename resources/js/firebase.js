// Import the functions you need from the SDKs you need
import {initializeApp} from "firebase/app";
import {getAnalytics} from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyBUT75xB9kR6taxQ5Sv-UpCNXpuNhnwnmQ",
    authDomain: "my-project-1489733461325.firebaseapp.com",
    projectId: "my-project-1489733461325",
    storageBucket: "my-project-1489733461325.appspot.com",
    messagingSenderId: "1019738238667",
    appId: "1:1019738238667:web:2d4e9c533b48221646354e",
    measurementId: "G-91FL1VPTBX"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);