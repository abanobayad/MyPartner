import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:flutter/material.dart';
import 'package:my_partner/screens/categories.dart';
import 'package:my_partner/screens/chat.dart';

class BottomNav extends StatefulWidget {
  const BottomNav({Key? key}) : super(key: key);

  @override
  State<BottomNav> createState() => _BottomNavState();
}

class _BottomNavState extends State<BottomNav> {
   int index = 1;
  @override
  Widget build(BuildContext context) {
    return CurvedNavigationBar(
      backgroundColor: Colors.transparent,
      height: MediaQuery.of(context).size.width * 0.12,
      items: const <Widget>[
        Icon(
          Icons.dashboard_rounded,
          size: 35,
          color: Colors.white,
        ),
        Icon(
          Icons.notifications,
          size: 35,
          color: Colors.white,
        ),
        Icon(
          Icons.home,
          size: 35,
          color: Colors.white,
        ),
        Icon(
          Icons.person,
          size: 35,
          color: Colors.white,
        ),
        Icon(
          Icons.menu_open,
          size: 35,
          color: Colors.white,
        ),
      ],
      color: Color.fromARGB(255, 150, 114, 251),
      buttonBackgroundColor: Color.fromARGB(255, 144, 114, 251),
      animationCurve: Curves.easeInOut,
      animationDuration: const Duration(milliseconds: 300),
      onTap: (selctedIndex) {
          setState(() {
            index = selctedIndex;
          });
        },
    );
  }
 Widget getSelectedWidget({required int index}) {
    Widget widget;
    switch (index) {
      case 0:
        widget = const chat();
        break;
      case 1:
        widget = const Categories();
        break;
      default:
        widget = const chat();
        break;
    }
    return widget;
  } 
}
