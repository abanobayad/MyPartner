import 'package:flutter/material.dart';

class SocialmediaButton extends StatelessWidget {
  final String label;
  final Color color;
  const SocialmediaButton(this.label, this.color, {Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialButton(
      minWidth: 300,
      height: 50,
      onPressed: () {},
      color: color,
      shape: RoundedRectangleBorder(
          side: BorderSide(
            color: color,
          ),
          borderRadius: BorderRadius.circular(20)),
      child: Text(
        label,
        style: const TextStyle(
          fontWeight: FontWeight.bold,
          fontSize: 16,
          color: Colors.white,
        ),
      ),
    );
  }
}
