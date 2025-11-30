"use client";
import { signIn, useSession } from "next-auth/react";
import Link from "next/link";
import { useContext, useState } from "react";
import SocialSignIn from "../social-button/SocialSignIn";
import toast, { Toaster } from 'react-hot-toast';
import { useRouter } from "next/navigation";
import Logo from "../../layout/header/logo";


const Signin = () => {
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [loginData, setLoginData] = useState({
    email: "",
    password: "",
  }); //login data state

  const [validationErrors, setValidationErrors] = useState({
    email: "",
    password: "",
  }); //validation state

  // Input validation function
  const validateForm = () => {
    let errors = { email: "", password: "" };
    let isValid = true;

    if (!loginData.email) {
      errors.email = "Email is required.";
      isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(loginData.email)) {
      errors.email = "Please enter a valid email address.";
      isValid = false;
    }

    if (!loginData.password) {
      errors.password = "Password is required.";
      isValid = false;
    } else if (loginData.password.length < 6) {
      errors.password = "Password must be at least 6 characters long.";
      isValid = false;
    }
    setValidationErrors(errors);
    return isValid;
  };

  // form handle submit
  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!validateForm()) {
      return;
    }
    setLoading(true);
    try {
      await new Promise((resolve) => setTimeout(resolve, 2000));
      localStorage.setItem("user", JSON.stringify({ user: loginData.email }));
      router.push("/");
    } catch (error) {
      alert("Something went wrong. Please try again.");
    } finally {
      setLoading(false);
    }
  };


  return (
    <div className="pt-40 pb-32 bg-light dark:bg-darkmode">
      <div className="pt-9 flex justify-center items-center text-center ">
        <div className="max-w-lg w-full bg-white dark:bg-semidark px-8 py-14 sm:px-12 md:px-16 rounded-lg">
          <div className="mb-10 text-center mx-auto inline-block max-w-[160px]">
            <Logo />
          </div>

          <SocialSignIn />

          <span className="z-1 relative my-8 block text-center">
            <span className="-z-1 absolute left-0 top-1/2 block h-px w-full bg-border dark:bg-dark_border"></span>
            <span className="text-primary/40 dark:text-border relative z-10 inline-block bg-white px-3 text-base dark:bg-semidark">
              OR
            </span>
            <Toaster />
          </span>

          <form onSubmit={handleSubmit}>
            <div className="mb-[22px]">
              <input
                required
                type="email"
                placeholder="Email"
                onChange={(e) =>
                  setLoginData({ ...loginData, email: e.target.value })
                }
                className="w-full rounded-md border placeholder:text-gray-400  border-border dark:border-dark_border border-solid bg-transparent px-5 py-3 text-base text-dark outline-none transition  focus:border-primary focus-visible:shadow-none dark:border-border_color dark:text-white dark:focus:border-primary"
              />
            </div>
            <div className="mb-[22px]">
              <input
                required
                type="password"
                placeholder="Password"
                onChange={(e) =>
                  setLoginData({ ...loginData, password: e.target.value })
                }
                className="w-full rounded-md border border-border dark:border-dark_border border-solid bg-transparent px-5 py-3 text-base text-dark outline-none transition  focus:border-primary focus-visible:shadow-none dark:border-border_color dark:text-white dark:focus:border-primary"
              />
            </div>
            <div className="mb-9">
              <button
                type="submit"
                className="flex w-full cursor-pointer items-center justify-center rounded-md border border-primary bg-primary hover:bg-primary/80 dark:hover:!bg-darkprimary px-5 py-3 text-base text-white transition duration-300 ease-in-out "
              >
                Sign In
              </button>

            </div>
          </form>

          <Link
            href="/forgot-password"
            className="mb-2 inline-block text-base text-dark hover:text-primary dark:text-white dark:hover:text-primary"
          >
            Forget Password?
          </Link>
          <p className="text-body-secondary text-base">
            Not a member yet?{" "}
            <Link href="/signup" className="text-body-secondary hover:text-primary">
              Sign Up
            </Link>
          </p>
        </div>
      </div>
    </div>
  );
};

export default Signin;