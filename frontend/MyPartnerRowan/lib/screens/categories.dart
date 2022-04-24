import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import '../model/categories_model.dart';
import '../model/chatModel.dart';
import '../widget/bottom_navbar.dart';
import '../widget/categoriesListwidget.dart';
import '../widget/chatListwidget.dart';
import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';

import 'chat.dart';

class Categories extends StatefulWidget {
  const Categories({Key? key}) : super(key: key);

  @override
  State<Categories> createState() => _CategoriesState();
}

class _CategoriesState extends State<Categories> {
  bool hide = false;
  bool _isInitialValue = true;

  List<Category> category = [
    Category(
      categoryName: "Shoes",
      NumItems: "200 items",
      imageURL: 'assets/images/gym.jpg',
    ),
    Category(
      categoryName: "Gym ",
      NumItems: "100 items ",
      imageURL: "assets/images/gym.jpg",
    ),
    Category(
      categoryName: "Football",
      NumItems: "55 items",
      imageURL: "assets/images/person2.jpg",
    ),
    Category(
      categoryName: "T-Shirt",
      NumItems: "22 items",
      imageURL: "assets/images/person3.jpg",
    ),
    Category(
      categoryName: "Backend",
      NumItems: "0 items",
      imageURL: "assets/images/person4-.jpg",
    ),
    Category(
      categoryName: "Frontend",
      NumItems: "101 items",
      imageURL: "assets/images/person5.jpg",
    ),
    Category(
      categoryName: "Food",
      NumItems: "50 items",
      imageURL: "assets/images/person6.jpg",
    ),
    Category(
      categoryName: "Skate",
      NumItems: "90 items",
      imageURL: "assets/images/person7.jpg",
    ),
  ];
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      drawerEnableOpenDragGesture: true,
      extendBody: true,
      bottomNavigationBar: const BottomNav(),
      appBar: PreferredSize(
        preferredSize: Size.fromHeight(40.0),
        child: AppBar(
          elevation: 0.1,
          automaticallyImplyLeading: false,
          backgroundColor: Colors.white,
          flexibleSpace: SafeArea(
            child: Container(
              padding: const EdgeInsets.only(right: 16),
              child: Row(
                  mainAxisSize: MainAxisSize.max,
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: <Widget>[
                    IconButton(
                      onPressed: () {
                        //Navigator.pop(context);
                      },
                      icon: const Icon(
                        Icons.arrow_back,
                        color: Color.fromARGB(255, 142, 103, 186),
                      ),
                    ),
                  ]),
            ),
          ),
        ),
      ),
      body: SingleChildScrollView(
        physics: const BouncingScrollPhysics(),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            Padding(
              padding: const EdgeInsets.only(left: 16, right: 16),
              child: Stack(
                children: [
                  AnimatedContainer(
                    padding: EdgeInsets.only(right: 20, left: 20),
                    decoration: BoxDecoration(
                      color: Color.fromARGB(59, 150, 114, 251),
                      borderRadius: BorderRadius.circular(12),
                    ),
                    duration: const Duration(seconds: 1),
                    width: _isInitialValue ? double.infinity : double.infinity,
                    height: _isInitialValue ? 230 : 170,
                    constraints: BoxConstraints(
                      maxWidth:
                          _isInitialValue ? double.infinity : double.infinity,
                      maxHeight: _isInitialValue ? 230 : 170,
                    ),
                  ),
                  Padding(
                    padding: EdgeInsets.only(left: 20, right: 20),
                    child: TextField(
                      decoration: InputDecoration(
                        prefixIcon: const Icon(
                          Icons.search,
                          color: Color.fromRGBO(173, 179, 191, 1),
                        ),
                        suffixIcon: IconButton(
                          icon: const Icon(Icons.clear),
                          onPressed: () {
                            /* Clear the search field */
                          },
                          color: Color.fromRGBO(173, 179, 191, 1),
                        ),
                        hintText: 'Search...',
                        hintStyle: const TextStyle(
                          color: Color.fromRGBO(173, 179, 191, 1),
                        ),
                        enabledBorder: const UnderlineInputBorder(
                          borderSide: BorderSide(
                              color: Color.fromRGBO(173, 179, 191, 1),
                              width: 2.0),
                        ),
                        focusedBorder: const UnderlineInputBorder(
                          borderSide: BorderSide(
                              color: Color.fromRGBO(173, 179, 191, 1),
                              width: 1.0),
                        ),
                      ),
                    ),
                  ),
                  const Padding(
                    padding: EdgeInsets.only(top: 60, left: 20),
                    child: Text(
                      "Select what you want..",
                      style: TextStyle(
                        color: Color.fromARGB(255, 152, 157, 167),
                        fontWeight: FontWeight.bold,
                        fontSize: 20,
                      ),
                    ),
                  ),
                  Container(
                    padding: EdgeInsets.only(top: 80, left: 10),
                    child: ListTile(
                      title: Row(
                        children: <Widget>[
                          SizedBox(
                            width: 80,
                            child: Expanded(
                              child: ElevatedButton(
                                onPressed: () {},
                                child: const Text(
                                  "Food",
                                  style: TextStyle(
                                    color: Colors.white,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                                style: ElevatedButton.styleFrom(
                                  padding: EdgeInsets.zero,
                                  primary: Color.fromARGB(151, 143, 108, 183),
                                  shape: RoundedRectangleBorder(
                                    borderRadius: BorderRadius.circular(40),
                                  ),
                                ),
                              ),
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.only(left: 20),
                            child: SizedBox(
                              width: 100,
                              child: Expanded(
                                child: ElevatedButton(
                                  onPressed: () {},
                                  child: const Text(
                                    "Football",
                                    style: TextStyle(
                                      color: Colors.white,
                                      fontWeight: FontWeight.bold,
                                    ),
                                  ),
                                  style: ElevatedButton.styleFrom(
                                    padding: EdgeInsets.zero,
                                    primary: Color.fromARGB(151, 143, 108, 183),
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(40),
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.only(left: 30),
                            child: SizedBox(
                              width: 70,
                              child: Expanded(
                                child: ElevatedButton(
                                  onPressed: () {},
                                  child: const Text(
                                    "K-pop",
                                    style: TextStyle(
                                      color: Colors.white,
                                      fontWeight: FontWeight.bold,
                                    ),
                                  ),
                                  style: ElevatedButton.styleFrom(
                                    padding: EdgeInsets.zero,
                                    primary: Color.fromARGB(151, 143, 108, 183),
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(40),
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                  Center(
                    child: Container(
                      padding: EdgeInsets.only(top: 140),
                      child: SafeArea(
                        child: Column(
                          children: [
                            if (!hide)
                              Container(
                                padding: const EdgeInsets.only(left: 20),
                                child: ListTile(
                                  title: Row(
                                    children: <Widget>[
                                      SizedBox(
                                        width: 120,
                                        child: Expanded(
                                          child: ElevatedButton(
                                            onPressed: () {},
                                            child: const Text(
                                              "java Script",
                                              style: TextStyle(
                                                color: Colors.white,
                                                fontWeight: FontWeight.bold,
                                              ),
                                            ),
                                            style: ElevatedButton.styleFrom(
                                              padding: EdgeInsets.zero,
                                              primary: const Color.fromARGB(
                                                  151, 143, 108, 183),
                                              shape: RoundedRectangleBorder(
                                                borderRadius:
                                                    BorderRadius.circular(40),
                                              ),
                                            ),
                                          ),
                                        ),
                                      ),
                                      Padding(
                                        padding:
                                            const EdgeInsets.only(left: 30),
                                        child: SizedBox(
                                          child: Expanded(
                                            child: ElevatedButton(
                                              onPressed: () {},
                                              child: const Text(
                                                "Shoes",
                                                style: TextStyle(
                                                  color: Colors.white,
                                                  fontWeight: FontWeight.bold,
                                                ),
                                              ),
                                              style: ElevatedButton.styleFrom(
                                                padding: EdgeInsets.zero,
                                                primary: const Color.fromARGB(
                                                    151, 143, 108, 183),
                                                shape: RoundedRectangleBorder(
                                                  borderRadius:
                                                      BorderRadius.circular(40),
                                                ),
                                              ),
                                            ),
                                          ),
                                        ),
                                      ),
                                    ],
                                  ),
                                ),
                              ),
                            GestureDetector(
                              onTap: () {
                                setState(() {
                                  hide = !hide;
                                  _isInitialValue = !_isInitialValue;
                                });
                              },
                              child: Text(
                                hide ? "Show more " : "Show less",
                                style: const TextStyle(
                                  color: Color.fromARGB(255, 152, 157, 167),
                                  fontWeight: FontWeight.w500,
                                  fontSize: 16,
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
            ListView.builder(
              physics: const BouncingScrollPhysics(),
              itemCount: category.length,
              shrinkWrap: true,
              itemBuilder: (context, index) {
                return CategoriesList(
                  categoryName: category[index].categoryName,
                  NumItems: category[index].NumItems,
                  imageUrl: category[index].imageURL,
                );
              },
            ),
          ],
        ),
      ),
    );
  }
}
