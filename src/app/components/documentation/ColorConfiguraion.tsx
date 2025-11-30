export const ColorConfiguration = () => {
    return (
        <>
            <h3 className=" text-black text-xl font-semibold mt-8 dark:text-white" >Colors</h3>
            <div className="p-6 rounded-md border mt-4 border-border dark:border-dark_border">
                <p className="text-base font-medium text-midnight_text dark:text-gray" ><span className="font-semibold text-lg dark:text-white">1. Override Colors</span> <br />
                    For any change in colors : src/utils/extendedConfig.ts</p>
                <div className="py-4 px-5 rounded-md bg-black mt-8">
                    <p className="text-sm text-lightgray flex flex-col gap-2">
                       <span>primary: "#2F73F2",</span>
                       <span>secondary: "#547593",</span>
                       <span>midnight_text: "#102D47",</span>
                       <span>gray: "#668199",</span>
                       <span>border: "#6bc5f94d",</span>
                       <span>light: "#F0F6FA",</span>
                       <span>section: "#F8FAFC",</span>
                       <span>darkmode: "#0c121e",</span>
                       <span>semidark: "#0e1624",</span>
                       <span>darklight: "#1F2A37",</span>
                       <span>dark_border: "#224767",</span>
                       <span>herobg: "#D1F2FF",</span>
                       <span>cyan: "#46C4FF",</span>
                       <span>lightgray:"#e5e7eb",</span>
                       <span>darkgray:"#374151",</span>
                    </p>
                </div>
            </div>
            <div className="p-6 rounded-md border mt-4 border-border dark:border-dark_border">
                <p className="text-base font-medium text-midnight_text dark:text-gray" ><span className="font-semibold text-lg dark:text-white">2. Override Theme Colors</span> <br />
                    For change , go to : src/utils/extendedConfig.ts</p>
                <div className="py-4 px-5 rounded-md bg-black mt-8">
                    <p className="text-sm text-lightgray flex flex-col gap-2">
                       <span>primary: "#2F73F2",</span>
                       <span>secondary: "#547593",</span>
                    </p>
                </div>
            </div>
        </>
    )
}