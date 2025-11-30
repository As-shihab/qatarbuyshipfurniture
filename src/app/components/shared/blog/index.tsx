import React from 'react'
import { getAllPosts } from "@/utils/markdown";
import BlogCard from './blogCard';

const BlogSmall: React.FC = () => {
    const posts = getAllPosts(["title", "date", "excerpt", "coverImage", "slug"]).slice(0, 2);

    return (
        <section className="flex flex-col dark:bg-darkmode px-4 md:px-4">
            <div className="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-0">
                <div className="items-center sm:mb-11 mb-7 flex justify-center">
                    <h2 className=" text-2xl sm:text-4xl text-midnight_text dark:text-white text-center font-bold">Blog Post</h2>
                </div>
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    {posts.map((blog, i) => (
                        <div key={i} className="w-full" data-aos="fade-up" data-aos-delay={`${i*200}`} data-aos-duration="1000">
                            <BlogCard blog={blog} />
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}

export default BlogSmall;
