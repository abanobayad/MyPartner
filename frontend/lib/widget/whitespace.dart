import 'package:flutter/material.dart';

class Whitespace extends StatelessWidget {
  final double space;
  const Whitespace(this.space, {Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      height: space,
    );
  }
}
