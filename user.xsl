<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/xhtml">
    
    <!-- Match the root element -->
    <xsl:template match="/system">
        <!-- <xsl:apply-imports/> -->
        <html>
            <head>
                <title>Students</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"/>
            </head>
            <style>
                table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 16px;
                border-radius: 8px; /* Add rounded corners to the table */
                overflow: hidden; /* Hide overflow content if any */
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
                }
                th, td {
                padding: 12px;
                border: 1px solid #ddd;
                text-align: center;
                }
                
                th {
                background-color: #f2f2f2;
                color: #333;
                font-weight: bold;
                }
                
                tr {
                <!-- border-bottom: 2px solid #000; /* Black border for each row */ -->
                }
                
                tr:hover {
                background-color: #f5f5f5;
                }
                
                
            </style>
            
            <body>
                <!-- Header -->
                <div class=" conatiner w-full h-24 bg-white shadow-md flex justify-between items-center px-12">
                    <div class="flex flex-col  ">
                        <h2 class="text-2xl font-bold ">ISIR Project</h2>
                        <h2 class="text-lg font-bold ">System Information</h2>
                    </div>
                    <input type='button' class="bg-transparent hover:bg-green-400 text-green-700 font-semibold hover:text-white py-2 px-10 border border-green-400 hover:border-transparent rounded" 
                           value='Logout' 
                           onclick="window.location.href='logout.php'" />
                    
                </div>
                
                <!-- List candidat information -->
                <div class="container mx-auto p-4">
                    
                    <div class="flex flex-row  justify-between m-2  ">
                        <h2 class="text-2xl font-bold mb-4  bg-green-400 px-4 py-2 rounded-full">Candidat Information</h2>
                        
                        <!-- <input type='button' class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-0 px-10 border border-blue-500 hover:border-transparent rounded" value='Add' onclick="window.location.href='add_user.php'" /> -->
                    </div>
                    <table class="w-full border-collapse border border-gray-800  text-center">
                        <thead>
                            <tr>
                                <th class="p-2 border border-gray-800 bg-green-400">Username</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Full Name</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Email</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Address</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Date Naissance</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Status</th>
                                <th class="p-2 border border-gray-800 bg-green-400 w-24">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Apply the transformation for each student element -->
                            <xsl:for-each select="//users/user[role ='user']">
                                <tr>
                                    <td class="p-2 border border-gray-800"><xsl:value-of select="username"/></td>
                                    <td class="p-2 border border-gray-800">
                                        <xsl:value-of select="concat(firstname, ' ', lastname)"/>
                                    </td>
                                    <td class="p-2 border border-gray-800"><xsl:value-of select="email"/></td>
                                    <td class="p-2 border border-gray-800">
                                        <xsl:value-of select="address/street"/>,
                                        <xsl:value-of select="address/city"/>,
                                        <xsl:value-of select="address/state"/>
                                    </td>
                                    <td class="p-2 border border-gray-800"><xsl:value-of select="dob"/></td>
                                    <td class="p-2 border border-gray-800 capitalize"><xsl:value-of select="status"/></td>
                                    
                                    <td class="p-2 border border-gray-800 w-44 space-x-2 space-y-2 ">
                                        <input type='button' class="bg-transparent hover:bg-green-400 text-green-400 font-semibold hover:text-white py-2 px-4 border border-green-400 hover:border-transparent rounded" value='show profile' onclick="window.location.href='profile.php?id={id}'" />
                                        <input type='button' class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" value='Update Status' onclick="window.location.href='update.php?id={id}'" />
                                        
                                        <input type='button' class="bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded" 
                                               value='Delete' 
                                               onclick="window.location.href='delete.php?id={id}'" />
                                    </td>
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                </div>
                <!-- List User Information -->
                
                <div class="container mx-auto p-4">
                    
                    <div class="flex flex-row  justify-between mt-2  ">
                        <h2 class="text-2xl font-bold mb-4  bg-green-400 px-4 py-2 rounded-full">User Information</h2>
                        
                        <input type='button' class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-0 px-10 border border-blue-500 hover:border-transparent rounded py-0 h-10" value='Add' onclick="window.location.href='add_user.php'" />
                    </div>
                    <table class="w-full border-collapse border border-gray-800  text-center">
                        <thead>
                            <tr>
                                <th class="p-2 border border-gray-800 bg-green-400">Username</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Full Name</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Email</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Address</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Date Naissance</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Role</th>
                                <th class="p-2 border border-gray-800 bg-green-400 w-24">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Apply the transformation for each student element -->
                            <xsl:for-each select="//users/user[role !='user']">
                                <tr>
                                    <td class="p-2 border border-gray-800"><xsl:value-of select="username"/></td>
                                    <td class="p-2 border border-gray-800">
                                        <xsl:value-of select="concat(firstname, ' ', lastname)"/>
                                    </td>
                                    <td class="p-2 border border-gray-800"><xsl:value-of select="email"/></td>
                                    <td class="p-2 border border-gray-800">
                                        <xsl:value-of select="address/street"/>,
                                        <xsl:value-of select="address/city"/>,
                                        <xsl:value-of select="address/state"/>
                                    </td>
                                    <td class="p-2 border border-gray-800"><xsl:value-of select="dob"/></td>
                                    <td class="p-2 border border-gray-800 capitalize"><xsl:value-of select="role"/></td>
                                    <xsl:choose>
                                        <xsl:when test="role != 'admin'">
                                            <td class="p-2 border border-gray-800 w-44 space-x-2 space-y-2 ">
                                                <input type='button' class="bg-transparent hover:bg-green-400 text-green-400 font-semibold hover:text-white py-2 px-4 border border-green-400 hover:border-transparent rounded" value='show profile' onclick="window.location.href='profile_user.php?id={id}'" />
                                                <input type='button' class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" value='Edit' onclick="window.location.href='update.php?id={id}'" />
                                                <input type='button' class="bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded" 
                                                       value='Delete' 
                                                       onclick="window.location.href='delete.php?id={id}'" />
                                            </td>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <td class="p-2 border border-gray-800 font-semibold">
                                                No action available
                                            </td>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                    
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                </div>
                <!-- List role - Permissions -->
                <div class="container mx-auto p-4">
                    
                    <div class="flex flex-row  justify-between m-2  ">
                        <h2 class="text-2xl font-bold mb-4  bg-green-400 px-4 py-2 rounded-full">List Role - Permissions</h2>
                        
                        <input type='button' class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-10 border border-blue-500 hover:border-transparent rounded h-10" value='Add' onclick="window.location.href='add_role.php'" />
                    </div>
                    <table class="w-full border-collapse border border-gray-800  text-center">
                        <thead>
                            <tr>
                                <th class="p-2 border border-gray-800 bg-green-400">role</th>
                                <th class="p-2 border border-gray-800 bg-green-400">permissions</th>
                                
                                <th class="p-2 border border-gray-800 bg-green-400 w-24">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Apply the transformation for each student element -->
                            <xsl:for-each select="//roles">
                                <tr>
                                    <td class="p-2 border border-gray-800 capitalize">
                                        <xsl:value-of select="role"/>
                                    </td>
                                    <td class=" flex flex-row flex-wrap p-4 space-x-1 space-y-1">
                                        <xsl:for-each select="permissions/permission">
                                            <span class="px-2 py-1 bg-green-400 text-white rounded-md">
                                                <xsl:value-of select="."/>
                                            </span>
                                            <br/>
                                        </xsl:for-each>
                                    </td>
                                    <xsl:choose>
                                        <xsl:when test="role != 'admin'">
                                            <td class="p-2 border border-gray-800 w-44 space-x-2 space-y-2">
                                                <input type='button' class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" value='Edit' onclick="window.location.href='edit_role.php?role={role}'" />
                                                <input type='button' class="bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded" 
                                                       value='Delete' 
                                                       onclick="window.location.href='delete_role.php?role={role}'" />
                                            </td>
                                        </xsl:when>
                                        <xsl:otherwise>
                                            <td class="p-2 border border-gray-800 font-semibold">
                                                No action available
                                            </td>
                                        </xsl:otherwise>
                                    </xsl:choose>
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                    
                </div> <!-- List diplome - speciality -->
                <div class="container mx-auto p-4">
                    
                    <div class="flex flex-row  justify-between m-2  ">
                        <h2 class="text-2xl font-bold mb-4  bg-green-400 px-4 py-2 rounded-full">List specialities - Diplomes</h2>
                        
                        <!-- <input type='button' class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-10 border border-blue-500 hover:border-transparent rounded" value='Add' onclick="window.location.href='add_role.php'" /> -->
                    </div>
                    <table class="w-full border-collapse border border-gray-800  text-center">
                        <thead>
                            <tr>
                                <th class="p-2 border border-gray-800 bg-green-400">speciality</th>
                                <th class="p-2 border border-gray-800 bg-green-400">Diplomes</th>
                                
                                <th class="p-2 border border-gray-800 bg-green-400 w-24">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Apply the transformation for each student element -->
                            <xsl:for-each select="//specialties/specialty">
                                <tr>
                                    <td class="p-2 border border-gray-800">
                                        <xsl:value-of select="name"/>
                                    </td>
                                    <td class=" flex flex-row flex-wrap p-4 space-x-1 space-y-1">
                                        
                                        <xsl:for-each select="diploma">
                                            <span class="px-2 py-1 bg-green-400 text-white rounded-md">
                                                <xsl:value-of select="."/>
                                            </span>
                                            <br/>
                                        </xsl:for-each>
                                        
                                    </td>
                                    <td class="p-2 border border-gray-800 w-44 space-x-2 space-y-2">
                                        <input type='button' class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" value='Edit'  onclick="window.location.href=''"  />
                                        <input type='button' class="bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded" 
                                               value='Delete' 
                                               onclick="window.location.href='delete_sp.php?sp={name}'"  />
                                    </td>
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                    
                </div>
                
                
            </body>
        </html>
    </xsl:template>
    
    
</xsl:stylesheet>
