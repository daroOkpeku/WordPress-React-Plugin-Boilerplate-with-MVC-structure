import { HashRouter, Routes, Route } from "react-router-dom";
import Homestart from "./scripts/Homestart";
import ExamplePage from "./scripts/ExamplePage";

// import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';
function App() {
  const baseUrl = window.GreatReactData?.baseUrl || "/";
  console.log(baseUrl);
  //api route: http://localhost/wordpress-React/wp-json/great_react/v1/tasks

  //http://localhost/wordpress-React/wp-admin
  return (
    <HashRouter>
      {/* <nav>{"navigator link"}</nav> */}
      <Routes>
        <Route path="/" element={<Homestart baseUrl={baseUrl} />} />
        <Route path="/stories" element={<ExamplePage baseUrl={baseUrl} />} />
      </Routes>
    </HashRouter>

    // <div>{renderPage()}</div>
  );
}

export default App;
