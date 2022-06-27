import React from "react";
import ReactDOM from "react-dom";
import App from "./App";
require('dotenv').config();
// console.log('process.env.CAPTCHA_SITE_KEY');
// console.log(process.env.REACT_APP_CAPTCHA_SITE_KEY);
ReactDOM.render(
<App />,
    document.getElementById("root")
);
