import React from 'react';
import { getAllPosts } from "@/utils/markdown";
import BlogCard from '../../shared/blog/blogCard';

const BlogList: React.FC = () => {
    const posts = getAllPosts(["title", "date", "excerpt", "coverImage", "slug"]);

    return (
        <section className="flex flex-wrap justify-center pt-8 lg:pb-24 pb-16 dark:bg-darkmode" id="blog">
            <div className="container mx-auto max-w-screen-xl">
                <div className="grid grid-cols-12 gap-7">
                    {posts.map((blog, i) => (
                        <div key={i} className="w-full col-span-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                            <BlogCard blog={blog} />
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}

export default BlogList;
