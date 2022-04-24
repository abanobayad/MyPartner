import 'package:flutter/material.dart';
import 'package:frontend/widget/button_decoration.dart';
import 'package:frontend/widget/buttonsocialmedia.dart';
import 'package:frontend/widget/text.dart';
import 'package:frontend/widget/whitespace.dart';

class Page2 extends StatefulWidget {
  const Page2({Key? key}) : super(key: key);

  @override
  State<Page2> createState() => _Page2State();
}

class _Page2State extends State<Page2> {
  TextEditingController email = TextEditingController();
  TextEditingController pass = TextEditingController();
  // bool passwordVisible = true;
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      backgroundColor: Colors.white,
      body: SafeArea(
        child: SingleChildScrollView(
          child: SizedBox(
            height: MediaQuery.of(context).size.height,
            width: double.infinity,
            child: Column(
              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
              children: [
                Column(
                  children: [
                    Container(
                      margin: const EdgeInsets.only(top: 20),
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                        children: const [
                          Text(
                            "Login",
                            style: TextStyle(
                              fontSize: 30,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          SizedBox(
                            height: 10,
                          ),
                          Text(
                            "Add your details to Log in",
                            style: TextStyle(
                              fontSize: 15,
                              color: Colors.grey,
                            ),
                          ),
                          SizedBox(
                            height: 15,
                          )
                        ],
                      ),
                    ),
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 40),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Textform('Email', Icon(Icons.person),
                              "emjaa5@example.com", false, email),
                          Whitespace(15),
                          Textform("Password", Icon(Icons.visibility), " ",
                              true, pass),
                          Whitespace(15),
                        ],
                      ),
                    ),
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 40),
                      child: Container(
                        padding: const EdgeInsets.only(top: 3, left: 3),
                        child: ElevatedButton(
                          onPressed: () {},
                          style: ElevatedButton.styleFrom(
                            padding: EdgeInsets.zero,
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(40),
                            ),
                          ),
                          child: const ButtonDecoration('Login'),
                        ),
                      ),
                    ),
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 40),
                      child: Container(
                        alignment: Alignment.center,
                        width: 300,
                        height: 60,
                        child: const Text(
                          "Forget Your Password?",
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 16,
                            color: Color.fromARGB(240, 158, 158, 158),
                          ),
                        ),
                      ),
                    ),
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 40),
                      child: Container(
                        alignment: Alignment.center,
                        width: 300,
                        height: 30,
                        child: const Text(
                          "or Log in with",
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 16,
                            color: Color.fromARGB(240, 158, 158, 158),
                          ),
                        ),
                      ),
                    ),
                    const SizedBox(
                      height: 10,
                    ),
                    const SocialmediaButton(
                        'Email', Color.fromARGB(255, 24, 25, 31)),
                    const Whitespace(10),
                    const SocialmediaButton(
                        'Facebook', Color.fromARGB(255, 25, 73, 229)),
                    const Whitespace(10),
                    const SocialmediaButton(
                        'Twitter', Color.fromARGB(255, 100, 168, 233)),
                    const Whitespace(15),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: const [
                        Text("Dont have an account?"),
                        Text(
                          "Sign Up",
                          style: TextStyle(
                            fontWeight: FontWeight.w600,
                            fontSize: 18,
                            color: Color.fromARGB(255, 150, 114, 251),
                          ),
                        ),
                      ],
                    )
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

//facebook Color.fromARGB(255, 25, 73, 229),
//twitter Color.fromARGB(255, 100, 168, 233)
//email   Color.fromARGB(255, 24, 25, 31)