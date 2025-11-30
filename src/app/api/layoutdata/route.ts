import { NextResponse } from "next/server";

const headerData = [
  { label: "Home", href: "/" },
  {
    label: "Properties",
    href: "#",
    submenu: [
      { label: "Property List", href: "/properties/properties-list" },
      { label: "Property Details", href: "/properties/properties-list/modern-apartment" },
    ],
  },
  {
    label: "Blogs",
    href: "#",
    submenu: [
      { label: "Blog Grid", href: "/blogs" },
      { label: "Blog Details", href: "/blogs/blog_1" },
    ],
  },
  { label: "Contact", href: "/contact" },
  { label: "Documentation", href: "/documentation" },
];

export const GET = async () => {
  return NextResponse.json({
    headerData
  });
};

