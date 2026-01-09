import React from "react";

function ExamplePage(props) {
  const { baseUrl } = props;
  const handleClick = () => {
    window.location.href = `${baseUrl}`;
  };
  return (
    <div className="w-full">
      <div className="w-[55%] m-auto py-2 px-2 border border-sm  flex flex-col  justify-center items-center shadom-sm gap-3 h-60">
        <h2 className="text-lg font-sans text-blue-400">
          WordPress React Plugin with MVC Architecture
        </h2>

        <div className="w-full flex  flex-row items-center ">
          <ul className="w-1/2  flex flex-col ">
            <li className="text-sm font-medium">
              1. Seamless React integration for WordPress
            </li>
            <li className="text-sm font-medium">2. Clean MVC architecture</li>
            <li className="text-sm font-medium">
              3. Integrated Tailwind CSS with WP style isolation
            </li>
            <li className="text-sm font-medium">4. Built-in routing system</li>
            <li className="text-sm font-medium">
              5. Optimized build process with Webpack and versioning
            </li>
          </ul>

          <section className="w-1/2  px-2 ">
            <div className="w-full flex flex-row">
              <section className="w-[120px] h-[120px] rounded-full overflow-hidden ">
                <img
                  src="https://ik.imagekit.io/9nikkw38wtz/Dabar_4cNDhyRDV?updatedAt=1706102750298"
                  className="w-full h-full object-cover"
                />
              </section>
              <article className="w-3/5">
                <ul className="w-full">
                  <li className="text-xs font-medium">
                    Created by: Okpeku Stephen Ighodaro
                  </li>
                  <li className="text-xs font-medium">
                    Tech Stack: PHP, React.js, Tailwind CSS, MySQL
                  </li>
                  <li></li>
                </ul>
              </article>
            </div>
          </section>
        </div>

        <span className="w-full px-2 flex flex-row gap-1">
          <h2 className="capitalize text-sm text-black">Home Page</h2>{" "}
          <h2
            onClick={handleClick}
            className="capitalize text-blue-500 cursor-pointer">
            Click Here
          </h2>
        </span>
      </div>
    </div>
  );
}

export default ExamplePage;
