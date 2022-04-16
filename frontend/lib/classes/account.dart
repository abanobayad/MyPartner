import 'dart:convert';
import 'package:frontend/url/constant.dart';
import 'package:http/http.dart' as http;

import '../url/constant.dart';

Future<void> register(String name, String email, String password) async {
  var myUrl = '${url}register';

  Map<String, String> data = {
    'name': name,
    'email': email,
    'password': password,
    'c_password': password
  };
  // print(data);

  String body = json.encode(data);

  final response = await http.post(Uri.parse(myUrl),
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: body);
  print(json.decode(response.body));
}
