import 'package:flutter/material.dart';

class Textform extends StatefulWidget {
  final String label, hint;
  final Icon icon;
  final bool securetext;

  final TextEditingController e;

  const Textform(this.label, this.icon, this.hint, this.securetext, this.e,
      {Key? key})
      : super(key: key);

  @override
  State<Textform> createState() => _TextformState();
}

class _TextformState extends State<Textform> {
  bool password = true;
  @override
  Widget build(BuildContext context) {
    return TextFormField(
      controller: widget.e,
      obscureText: widget.securetext ? password : widget.securetext,
      decoration: InputDecoration(
        labelText: widget.label,
        hintText: widget.hint,
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
        suffixIcon: widget.securetext
            ? Padding(
                padding: const EdgeInsets.all(0.0),
                child: IconButton(
                  onPressed: () {
                    setState(() {
                      password = !password;
                    });
                  },
                  icon:
                      Icon(password ? Icons.visibility : Icons.visibility_off),
                ),
              )
            : null,
        prefixIcon: widget.securetext
            ? null
            : Padding(
                padding: const EdgeInsets.all(8.0),
                child: widget.icon,
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
    );
  }
}
