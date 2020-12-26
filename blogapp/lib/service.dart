import 'dart:convert';
import 'package:http/http.dart'
    as http; 
import 'post.dart';
class Services {
  static const ROOT = 'http://192.168.0.132//kuliah/WebDinamis/function/services.php'; 


  static Future<List<Post>> getPost() async {
    try {
      var map = Map<String, dynamic>();
      map['action'] = 'GET_POST';
      final response = await http.post(ROOT, body: map);
      print('getpost Response: ${response.body}');
      if (200 == response.statusCode) {
        List<Post> list = parseResponse(response.body);
        return list;
      } else {
        return List<Post>();
      }
    } catch (e) {
      print(e);
      return List<Post>(); // return an empty list on exception/error
    }
  }

  static Future<String> getNamaPenulis(String idpenulis) async {
    try {
      var map = Map<String, dynamic>();
      map['action'] = 'GET_NAMA_PENULIS';
      map['idpenulis'] = idpenulis;
      final response = await http.post(ROOT, body: map);
      print('getnamapenulis Response: ${response.body}');
      if (200 == response.statusCode) {
        final penulis = jsonDecode(response.body);
        print('getnamapenulis Response: ${penulis[0]['nama']}');
        return penulis[0]['nama'];
      } else {
        return '';
      }
    } catch (e) {
      print(e);
      return ''; // return an empty list on exception/error
    }
  }


  static List<Post> parseResponse(String responseBody) {
    final parsed = json.decode(responseBody).cast<Map<String, dynamic>>();
    return parsed.map<Post>((json) => Post.fromJson(json)).toList();
  }


}