import React, { useState } from "react";
// import { Link } from "react-router-dom";
// import { baseurl } from "../global";
function Homestart(props) {
  const { baseUrl } = props;
  const [count, Setcount] = useState(0);
  const handleClick = () => {
    window.location.href = `${baseUrl}#/stories`;
  };
  return (
    <div className="w-full">
      <div className="w-[55%] m-auto py-2 px-2 border border-sm  flex flex-col  justify-center items-center shadom-sm gap-3 h-60">
        <h2 className="text-lg font-sans text-blue-400">
          WordPress React Plugin with MVC Architecture
        </h2>

        <h5 className="text-base font-medium">
          This open-source WordPress plugin utilizes an MVC architecture, built with React.js and Tailwind CSS, to provide developers with a solid foundation for rapid development and minimal setup.
        </h5>
        <h5 className="text-base font-medium">
          Contributions and improvements to this plugin are welcome
        </h5>

        <span className="w-full px-2 flex flex-row gap-1">
          <h2 className="capitalize text-sm text-black">Next Page</h2>{" "}
          <h2
            onClick={handleClick}
            className="capitalize text-blue-500 cursor-pointer">
            Click Here
          </h2>
        </span>

        <section className="w-full flex flex-col items-center justify-center">
          <span className="text-black text-lg capitalize">
            Counter {count}
          </span>
          <article className="w-1/2 m-auto flex flex-row items-center justify-between">
            <button
              className="text-base font-normal capitalize cursor-pointer px-2 py-2 bg-green-400 text-white rounded-md hover:bg-white hover:text-green-400"
              onClick={() => Setcount((prev) => prev + 1)}>
              Increase
            </button>
            <button
              className="text-base font-normal capitalize cursor-pointer px-2 py-2 bg-red-400 text-white rounded-md hover:bg-white hover:text-red-400"
              onClick={() => Setcount((prev) => prev - 1)}>
              Decrease
            </button>
          </article>
        </section>
      </div>
    </div>
  );
}

export default Homestart;
