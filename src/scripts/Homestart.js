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
          WordPress React Plugin Boilerplate with MVC Structure
        </h2>

        <h5 className="text-base font-medium">
          An open-source WordPress plugin boilerplate with an MVC structure,
          React.js, and Tailwind CSS, designed to let developers start coding
          immediately without setup.
        </h5>
        <h5 className="text-base font-medium">
          Please make contribution and correction to this Plugin{" "}
        </h5>

        <span className="w-full px-2 flex flex-row gap-1">
          <h2 className="capitalize text-sm text-black">next page</h2>{" "}
          <h2
            onClick={handleClick}
            className="capitalize text-blue-500 cursor-pointer">
            click here
          </h2>
        </span>

        <section className="w-full flex flex-col items-center justify-center">
          <span className="text-black text-lg capitalize">
            Total count {count}
          </span>
          <article className="w-1/2 m-auto flex flex-row items-center justify-between">
            <button
              className="text-base font-normal capitalize cursor-pointer px-2 py-2 bg-green-400 text-white rounded-md hover:bg-white hover:text-green-400"
              onClick={() => Setcount((prev) => prev + 1)}>
              incease count
            </button>
            <button
              className="text-base font-normal capitalize cursor-pointer px-2 py-2 bg-red-400 text-white rounded-md hover:bg-white hover:text-red-400"
              onClick={() => Setcount((prev) => prev - 1)}>
              decrease count
            </button>
          </article>
        </section>
      </div>
    </div>
  );
}

export default Homestart;
