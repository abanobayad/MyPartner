import 'package:flutter/material.dart';

class ButtonDecoration extends StatelessWidget {
  final String label;
  const ButtonDecoration(this.label, {Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Ink(
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
        child: Text(label,
            style: const TextStyle(
                fontWeight: FontWeight.bold,
                fontSize: 16,
                color: Colors.white)),
      ),
    );
  }
}
