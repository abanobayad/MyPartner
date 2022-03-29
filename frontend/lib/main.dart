import 'package:flutter/material.dart';
import 'package:frontend/screens/signup.dart';

void main() => runApp(const MyApp());

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'MyPartner',
      theme: ThemeData(
        colorScheme: Theme.of(context).colorScheme.copyWith(
              primary: const Color.fromARGB(255, 193, 74, 230),
            ),
      ),
      home: const SignUp(),
    );
  }
}
