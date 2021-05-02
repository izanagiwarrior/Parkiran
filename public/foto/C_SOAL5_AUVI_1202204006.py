class app:
    def login(self):
        username = str(input("Username : "))
        password = str(input("Password : "))

        if username == "alpro" and password == "daspro":
            print("""
            Login Success
            Welcome To My App !
            """)
        else:
            print("Log-in gagal")
    def logout(self):
        print("You're successfully logged out. Thank you for using me")

if __name__ == "__main__":
    auvi = False
    while True:
        print("""
        User Testing Application
        1.login
        2.logout
        """)
        inputuser=int(input("Choose Menu ? : "))

        if inputuser==1:
            app=app()
            app.login()
            auvi=True
            print()
        elif inputuser == 2 and auvi == False:
            print("""
            !!! Login First !!!
            """)
        elif inputuser == 2 and auvi == True:
            app.login()
            break
        else:
            print("!! No Option !!")
