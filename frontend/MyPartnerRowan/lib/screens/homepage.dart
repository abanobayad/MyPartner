import 'package:flutter/material.dart';
import 'package:my_partner/screens/login.dart';
import 'package:my_partner/screens/signup.dart';

class homepage extends StatefulWidget {
  const homepage({Key? key}) : super(key: key);
// _ make class private معرفش اجيبه من ملف برا بس من هناا
  @override
  State<StatefulWidget> createState() => _homepageState();
}

class _homepageState extends State<homepage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: Container(
          height: MediaQuery.of(context).size.height,
          width: double.infinity,
          child: Column(
            children: [
              Container(
                child: Image.asset(
                  'assets/images/homepage.png',
                  fit: BoxFit.cover,
                ),
              ),
              Container(
                padding: const EdgeInsets.only(top: 3, left: 3),
                margin: const EdgeInsets.only(top: 140),
                child: ElevatedButton(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => const LoginPage()),
                    );
                  },
                  style: ElevatedButton.styleFrom(
                    padding: EdgeInsets.zero,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(40),
                    ),
                  ),
                  child: Ink(
                    decoration: BoxDecoration(
                      gradient: const LinearGradient(colors: [
                        Color.fromARGB(255, 214, 114, 251),
                        Color.fromARGB(255, 150, 114, 251)
                      ]),
                      borderRadius: BorderRadius.circular(40),
                    ),
                    child: Container(
                      alignment: Alignment.center,
                      width: 270,
                      height: 60,
                      child: const Text(
                        "Login",
                        style: TextStyle(
                            fontWeight: FontWeight.w900,
                            fontSize: 16,
                            color: Colors.white),
                      ),
                    ),
                  ),
                ),
              ),
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 40),
                child: Container(
                  margin: EdgeInsets.only(top: 15),
                  padding: EdgeInsets.only(top: 3, left: 3),
                  decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(40),
                      border: const Border(
                          bottom: BorderSide(
                              color: Color.fromARGB(255, 150, 114, 251)),
                          top: BorderSide(
                              color: Color.fromARGB(255, 150, 114, 251)),
                          right: BorderSide(
                              color: Color.fromARGB(255, 150, 114, 251)),
                          left: BorderSide(
                              color: Color.fromARGB(255, 150, 114, 251)))),
                  child: MaterialButton(
                    minWidth: double.infinity,
                    height: 60,
                    onPressed: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) => const SignupPage()),
                      );
                    },
                    color: Colors.white,
                    shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(40)),
                    child: const Text(
                      "creat new account",
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                        color: Color.fromARGB(255, 150, 114, 251),
                      ),
                    ),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
