import 'package:flutter/material.dart';

import '../screens/chatDetail.dart';

class CategoriesList extends StatefulWidget {
  String categoryName;
  String NumItems;
  String imageUrl;

  CategoriesList({
    required this.categoryName,
    required this.NumItems,
    required this.imageUrl,
  });
  @override
  _CategoriesListState createState() => _CategoriesListState();
}

class _CategoriesListState extends State<CategoriesList> {
  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) {
            return ChatDetailPage();
          }),
        );
      },
      child: Stack(
        children: [
          Container(
            height: 85,
            margin:
                const EdgeInsets.only(top: 20, left: 40, right: 40, bottom: 10),
            padding: const EdgeInsets.only(left: 55),
            decoration: const BoxDecoration(
              color: Color.fromARGB(255, 255, 255, 255),
              borderRadius: BorderRadius.only(
                topLeft: Radius.circular(50),
                bottomLeft: Radius.circular(50),
                topRight: Radius.circular(20),
                bottomRight: Radius.circular(20),
              ),
              boxShadow: [
                BoxShadow(
                    color: Color.fromARGB(176, 132, 132, 132), blurRadius: 5.0),
              ],
              shape: BoxShape.rectangle,
            ),
            child: Row(
              children: <Widget>[
                Expanded(
                  child: Row(
                    children: <Widget>[
                      Expanded(
                        child: Container(
                          margin: const EdgeInsets.only(top: 20),
                          color: Colors.transparent,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text(
                                widget.categoryName,
                                style: const TextStyle(
                                  fontSize: 20,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              const SizedBox(
                                height: 6,
                              ),
                              Text(
                                widget.NumItems,
                                style: TextStyle(
                                  fontSize: 13,
                                  color: Colors.grey.shade600,
                                ),
                              ),
                            ],
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
          Container(
            margin: EdgeInsets.only(left: 18, top: 28),
            child: CircleAvatar(
              backgroundImage: AssetImage(widget.imageUrl),
              maxRadius: 35,
            ),
          ),
          Container(
            margin: EdgeInsets.only(left: 330, top: 38),
            width: 35,
            decoration: const BoxDecoration(
              color: Color.fromARGB(255, 255, 255, 255),
              boxShadow: [
                BoxShadow(
                    color: Color.fromARGB(178, 65, 61, 61), blurRadius: 5.0),
              ],
              shape: BoxShape.circle,
            ),
            child: IconButton(
              onPressed: () {
                //Navigator.pop(context);
              },
              icon: const Icon(
                Icons.arrow_forward_ios,
                color: Color.fromARGB(255, 142, 103, 186),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
