import React from "react";
import { Bell, User, ChevronDown, LogOut } from "lucide-react";

const DashboardLayout = () => {
    return (
        <div className="min-h-screen bg-gray-100">
            {/* Header */}
            <header className="bg-white shadow-sm">
                <div className="flex justify-between items-center px-6 py-4">
                    <div className="flex items-center gap-4">
                        <img
                            src="/api/placeholder/40/40"
                            alt="Logo Bea Cukai"
                            className="h-10"
                        />
                        <h1 className="text-xl font-semibold text-blue-800">
                            Sistem Informasi Kepegawaian KPPBC TMP C Lhokseumawe
                        </h1>
                    </div>

                    <div className="flex items-center gap-4">
                        <button className="p-2 rounded-full hover:bg-gray-100">
                            <Bell className="w-5 h-5 text-gray-600" />
                        </button>

                        <div className="relative">
                            <button className="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100">
                                <div className="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center">
                                    <User className="w-5 h-5 text-white" />
                                </div>
                                <span className="text-sm font-medium">
                                    Admin Name
                                </span>
                                <ChevronDown className="w-4 h-4 text-gray-600" />
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <div className="flex">
                {/* Sidebar */}
                <aside className="w-64 min-h-screen bg-blue-800 text-white">
                    <nav className="p-4">
                        <div className="space-y-4">
                            <a
                                href="#"
                                className="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-700"
                            >
                                <span>Info Pegawai</span>
                            </a>
                            <div className="pl-4 space-y-2">
                                <a
                                    href="#"
                                    className="block px-4 py-2 text-sm rounded-lg hover:bg-blue-700"
                                >
                                    Grading
                                </a>
                                <a
                                    href="#"
                                    className="block px-4 py-2 text-sm rounded-lg hover:bg-blue-700"
                                >
                                    Pangkat
                                </a>
                                <a
                                    href="#"
                                    className="block px-4 py-2 text-sm rounded-lg hover:bg-blue-700"
                                >
                                    KGB
                                </a>
                            </div>
                            <a
                                href="#"
                                className="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-700"
                            >
                                <span>Monitoring</span>
                            </a>
                            <a
                                href="#"
                                className="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-700"
                            >
                                <span>Data Pegawai</span>
                            </a>
                            <a
                                href="#"
                                className="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-700"
                            >
                                <span>Laporan</span>
                            </a>
                        </div>
                    </nav>
                </aside>

                {/* Main Content */}
                <main className="flex-1 p-6">
                    <div className="bg-white rounded-lg shadow-sm p-6">
                        <h2 className="text-lg font-semibold mb-4">
                            Dashboard Overview
                        </h2>
                        {/* Content will go here */}
                    </div>
                </main>
            </div>
        </div>
    );
};

export default DashboardLayout;
