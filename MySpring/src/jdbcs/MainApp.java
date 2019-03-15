package jdbcs;

import java.util.List;
import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;
import jdbcs.StudentJDBCTemplate;

public class MainApp
{
	public static void main(String[] args) {
		ApplicationContext context = new ClassPathXmlApplicationContext("BeansJDBC.xml");

		StudentJDBCTemplate studentJDBCTemplate = (StudentJDBCTemplate) context.getBean("studentJDBCTemplate");

		System.out.println("---------Records Creation----------");
		studentJDBCTemplate.create("Zara", 11);
		studentJDBCTemplate.create("Nuha", 2);
		studentJDBCTemplate.create("Ayan", 15);

		System.out.println("---------List Multiple Records-------");
		List<Student> students = studentJDBCTemplate.listStudent();

		for (Student record : students) {
			System.out.println("ID : " + record.getId());
			System.out.println(" , Name : " + record.getName());
			System.out.println("， Age : " + record.getAge());
		}

		System.out.println("--------Update Record with Id = 2 --------");
		studentJDBCTemplate.update(2, 20);

		System.out.println("-------List Record with ID = 2 ----------");
		Student student = studentJDBCTemplate.getStudent(2);
		System.out.println("ID : " + student.getId());
		System.out.println(", Name : " + student.getName());
		System.out.println(", Age : " + student.getAge());
	}
}
