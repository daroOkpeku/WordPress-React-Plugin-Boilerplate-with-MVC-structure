import Homestart from "./scripts/Homestart";
import App from "./App";
import React from "react";
import { createRoot } from "react-dom/client";
import "./index.css";
window.React = React;

const element = document.getElementById("great-react-root");
console.log(element);

if (element) {
  const pages = element?.getAttribute("data-page");
  console.log(pages);
  //   const root = ReactDOM.createRoot(element);
  const root = createRoot(element); // React 18 API
  // root.render(<Homestart />);
  root.render(<App pages={pages} />);
}
