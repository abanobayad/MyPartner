import 'package:flutter/material.dart';
import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:my_partner/screens/categories.dart';
import 'package:my_partner/screens/contact_us.dart';
import 'package:my_partner/screens/homepage.dart';
import 'package:my_partner/screens/login.dart';
import 'package:my_partner/screens/signup.dart';

import 'screens/chat.dart';
import 'screens/categories.dart';

void main() => runApp(
      const MyApp(),
    );

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      debugShowCheckedModeBanner: false,
      home: LoginPage(),
    );
  }
}
