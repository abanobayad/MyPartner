import 'package:flutter/material.dart';

class SignupPage extends StatefulWidget {
  const SignupPage({Key? key}) : super(key: key);

  @override
  State<SignupPage> createState() => _SignupPageState();
}

class _SignupPageState extends State<SignupPage> {
  @override
  bool passwordVisible = true;

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
                          TextFormField(
                            decoration: const InputDecoration(
                              labelText: "First name",
                              hintText: "em ",
                              labelStyle: TextStyle(
                                fontSize: 15,
                                fontWeight: FontWeight.w600,
                                color: Color.fromARGB(195, 0, 0, 0),
                              ),
                              contentPadding: EdgeInsets.symmetric(
                                vertical: 0,
                                horizontal: 10,
                              ),
                              enabledBorder: OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Color.fromARGB(125, 158, 158, 158),
                                ),
                              ),
                              prefixIcon: Padding(
                                padding: EdgeInsets.all(8.0),
                                child: Icon(Icons.person),
                              ),
                              border: OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Colors.grey,
                                ),
                              ),
                            ),
                          ),
                          const SizedBox(
                            height: 25,
                          ),
                          TextFormField(
                            decoration: const InputDecoration(
                              labelText: "Last name",
                              hintText: " jaa",
                              labelStyle: TextStyle(
                                fontSize: 15,
                                fontWeight: FontWeight.w600,
                                color: Color.fromARGB(195, 0, 0, 0),
                              ),
                              contentPadding: EdgeInsets.symmetric(
                                vertical: 0,
                                horizontal: 10,
                              ),
                              enabledBorder: OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Color.fromARGB(125, 158, 158, 158),
                                ),
                              ),
                              prefixIcon: Padding(
                                padding: EdgeInsets.all(8.0),
                                child: Icon(Icons.person),
                              ),
                              border: OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Colors.grey,
                                ),
                              ),
                            ),
                          ),
                          const SizedBox(
                            height: 25,
                          ),
                          TextFormField(
                            decoration: const InputDecoration(
                              labelText: "Email",
                              hintText: "emjaa5@example.com",
                              labelStyle: TextStyle(
                                fontSize: 15,
                                fontWeight: FontWeight.w600,
                                color: Color.fromARGB(195, 0, 0, 0),
                              ),
                              contentPadding: EdgeInsets.symmetric(
                                vertical: 0,
                                horizontal: 10,
                              ),
                              enabledBorder: OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Color.fromARGB(125, 158, 158, 158),
                                ),
                              ),
                              prefixIcon: Padding(
                                padding: EdgeInsets.all(8.0),
                                child: Icon(Icons.person),
                              ),
                              border: OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Colors.grey,
                                ),
                              ),
                            ),
                          ),
                          const SizedBox(
                            height: 25,
                          ),
                          TextFormField(
                            obscureText: passwordVisible,
                            decoration: InputDecoration(
                              labelText: "Password",
                              labelStyle: const TextStyle(
                                fontSize: 15,
                                fontWeight: FontWeight.w600,
                                color: Color.fromARGB(195, 0, 0, 0),
                              ),
                              contentPadding: const EdgeInsets.symmetric(
                                vertical: 0,
                                horizontal: 10,
                              ),
                              enabledBorder: const OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Color.fromARGB(125, 158, 158, 158),
                                ),
                              ),
                              suffixIcon: Padding(
                                padding: EdgeInsets.all(0.0),
                                child: IconButton(
                                  onPressed: () {
                                    setState(() {
                                      passwordVisible = !passwordVisible;
                                    });
                                  },
                                  icon: Icon(passwordVisible
                                      ? Icons.visibility
                                      : Icons.visibility_off),
                                ),
                              ),
                              border: const OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Colors.grey,
                                ),
                              ),
                            ),
                          ),
                          const SizedBox(
                            height: 25,
                          ),
                          TextFormField(
                            obscureText: passwordVisible,
                            decoration: InputDecoration(
                              labelText: "Confirm Password",
                              labelStyle: const TextStyle(
                                fontSize: 15,
                                fontWeight: FontWeight.w600,
                                color: Color.fromARGB(195, 0, 0, 0),
                              ),
                              contentPadding: const EdgeInsets.symmetric(
                                vertical: 0,
                                horizontal: 10,
                              ),
                              enabledBorder: const OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Color.fromARGB(125, 158, 158, 158),
                                ),
                              ),
                              suffixIcon: Padding(
                                padding: EdgeInsets.all(0.0),
                                child: IconButton(
                                  onPressed: () {
                                    setState(() {
                                      passwordVisible = !passwordVisible;
                                    });
                                  },
                                  icon: Icon(passwordVisible
                                      ? Icons.visibility
                                      : Icons.visibility_off),
                                ),
                              ),
                              border: const OutlineInputBorder(
                                borderRadius: BorderRadius.all(
                                  Radius.circular(15),
                                ),
                                borderSide: BorderSide(
                                  color: Colors.grey,
                                ),
                              ),
                            ),
                          ),
                          const SizedBox(
                            height: 50,
                          ),
                        ],
                      ),
                    ),
                    //el Button bta3t el sign up
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
                              width: 300,
                              height: 60,
                              child: const Text("Sign Up",
                                  style: TextStyle(
                                      fontWeight: FontWeight.bold,
                                      fontSize: 16,
                                      color: Colors.white)),
                            ),
                          ),
                        ),
                      ),
                    ),
                    const SizedBox(
                      height: 10,
                    ),
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
