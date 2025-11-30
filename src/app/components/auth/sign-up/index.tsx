"use client";
import Link from "next/link";
import SocialSignUp from "../social-button/SocialSignUp";
import { useState } from "react";
import { useRouter } from "next/navigation";
import Loader from "../../shared/Loader";
import Logo from "../../layout/header/logo";
const SignUp = () => {
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
  });
  const [errors, setErrors] = useState({
    name: "",
    email: "",
    password: "",
  });

  // Validation functions
  const validateName = (name: string) => {
    if (!name.trim()) return "Name is required";
    if (!/^[a-zA-Z\s]{3,}$/.test(name)) return "Name must be at least 3 characters and contain only letters";
    return "";
  };

  const validateEmail = (email: string) => {
    if (!email.trim()) return "Email is required";
    if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) return "Enter a valid email address";
    return "";
  };

  const validatePassword = (password: string) => {
    if (!password.trim()) return "Password is required";
    if (password.length < 6) return "Password must be at least 6 characters";
    return "";
  };

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));

    // Validate on change
    setErrors((prev) => ({
      ...prev,
      [name]: name === "name"
        ? validateName(value)
        : name === "email"
          ? validateEmail(value)
          : validatePassword(value),
    }));
  };

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    // Validate all fields before submitting
    const nameError = validateName(formData.name);
    const emailError = validateEmail(formData.email);
    const passwordError = validatePassword(formData.password);

    setErrors({ name: nameError, email: emailError, password: passwordError });
    if (nameError || emailError || passwordError) {
      return;
    }

    setLoading(true);
    try {
      await new Promise((resolve) => setTimeout(resolve, 2000));
      localStorage.setItem("user", JSON.stringify({ user: formData.name }));
      router.push("/");
    } catch (error) {
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="pt-40 pb-32 bg-light dark:bg-darkmode">
      <div className="pt-11 flex justify-center items-center text-center ">
        <div className="max-w-lg w-full bg-white dark:bg-semidark px-8 py-14 sm:px-12 md:px-16 rounded-lg">
          <div className="mb-10 text-center mx-auto inline-block max-w-[160px]">
            <Logo />
          </div>

          <SocialSignUp />

          <span className="z-1 relative my-8 block text-center">
            <span className="-z-1 absolute left-0 top-1/2 block h-px w-full bg-border dark:bg-dark_border"></span>
            <span className="text-primary/40 dark:text-border relative z-10 inline-block bg-white px-3 text-base dark:bg-semidark">
              OR
            </span>
          </span>

          <form onSubmit={handleSubmit}>
            <div className="mb-4">
              <input
                type="text"
                placeholder="Name"
                name="name"
                value={formData.name}
                onChange={handleChange}
                required
                className="w-full rounded-md border border-border dark:border-darkborder  bg-transparent px-5 py-3 text-base text-midnight_text outline-none transition placeholder:text-gray-300 focus:border-primary focus-visible:shadow-none dark:text-white dark:focus:border-primary"
              />
            </div>
            <div className="mb-4">
              <input
                type="email"
                placeholder="Email"
                name="email"
                value={formData.email}
                onChange={handleChange}
                required
                className="w-full rounded-md border border-border dark:border-darkborder  bg-transparent px-5 py-3 text-base text-midnight_text outline-none transition placeholder:text-gray-300 focus:border-primary focus-visible:shadow-none dark:text-white dark:focus:border-primary"
              />
            </div>
            <div className="mb-4">
              <input
                type="password"
                placeholder="Password"
                name="password"
                value={formData.password}
                onChange={handleChange}
                required
                className="w-full rounded-md border border-border dark:border-darkborder border-solid bg-transparent px-5 py-3 text-base text-midnight_text outline-none transition placeholder:text-gray-300 focus:border-primary focus-visible:shadow-none dark:text-white dark:focus:border-primary"
              />
            </div>

            <div className="mb-9">
              <button
                type="submit"
                className="flex w-full cursor-pointer items-center justify-center rounded-md bg-primary hover:bg-DarkPrimary px-5 py-3 text-base text-white transition duration-300 ease-in-out hover:!bg-darkprimary dark:hover:!bg-darkprimary"
              >
                Sign Up {loading && <Loader />}
              </button>
            </div>
          </form>

          <p className="text-midnight_text dark:text-white mb-4 text-base">
            By creating an account you are agree with our{" "}
            <a href="/#" className="text-midnight_text dark:text-white hover:text-primary dark:hover:text-primary">
              Privacy
            </a>{" "}
            and{" "}
            <a href="/#" className="text-midnight_text dark:text-white hover:text-primary dark:hover:text-primary">
              Policy
            </a>
          </p>

          <p className="text-midnight_text dark:text-white text-base">
            Already have an account?
            <Link
              href="/signin"
              className="pl-2 text-midnight_text dark:text-white hover:text-primary dark:hover:text-primary"
            >
              Sign In
            </Link>
          </p>
        </div>
      </div>
    </div>
  );
};

export default SignUp;
