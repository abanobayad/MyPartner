import 'package:flutter/material.dart';
import 'package:frontend/widget/button_decoration.dart';
import 'package:frontend/widget/text.dart';
import 'package:frontend/widget/whitespace.dart';

import '../classes/account.dart';

class SignUp extends StatefulWidget {
  const SignUp({Key? key}) : super(key: key);

  @override
  State<SignUp> createState() => _SignUpState();
}

class _SignUpState extends State<SignUp> {
  TextEditingController fname = TextEditingController();
  TextEditingController lname = TextEditingController();
  TextEditingController email = TextEditingController();
  TextEditingController pass = TextEditingController();
  TextEditingController cpass = TextEditingController();

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
                            "Sign up",
                            style: TextStyle(
                              fontSize: 30,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          SizedBox(
                            height: 10,
                          ),
                          Text(
                            "Add your details to sign Up",
                            style: TextStyle(
                              fontSize: 15,
                              color: Color.fromARGB(190, 97, 97, 97),
                            ),
                          ),
                          SizedBox(
                            height: 20,
                          )
                        ],
                      ),
                    ),
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 40),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Textform("First Name", const Icon(Icons.person),
                              "add your First Name", false, fname),
                          const Whitespace(25),
                          Textform("Last Name", const Icon(Icons.person),
                              "add your Last Name", false, lname),
                          const Whitespace(25),
                          Textform("Email", const Icon(Icons.person),
                              "add your name", false, email),
                          const Whitespace(25),
                          Textform("Password", const Icon(Icons.visibility),
                              " ", true, pass),
                          const Whitespace(25),
                          Textform("Confirm Your Password",
                              const Icon(Icons.visibility), "", true, cpass),
                          const Whitespace(25),
                        ],
                      ),
                    ),
                    //el Button bta3t el sign up
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 40),
                      child: Container(
                        padding: const EdgeInsets.only(top: 3, left: 3),
                        child: ElevatedButton(
                            onPressed: () {
                              setState(() {
                                String name = fname.text + " " + lname.text;
                                register(name, email.text, pass.text);
                              });
                            },
                            style: ElevatedButton.styleFrom(
                              padding: EdgeInsets.zero,
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(40),
                              ),
                            ),
                            //button decoration
                            child: const ButtonDecoration("Sign Up")),
                      ),
                    ),
                    const Whitespace(15),
                    //goz2 Already have an account?
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: const [
                        Text("Already have an account? "),
                        Text(
                          "Login",
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
